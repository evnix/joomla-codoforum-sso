<?php

/**
 * HTML parsing, filtering and sanitization
 * This class depends on Tidy which is included in the core since PHP 5.3
 *
 * @author Eksith Rodrigo <reksith at gmail.com>
 * @license http://opensource.org/licenses/ISC ISC License
 * @version 0.2
 */

namespace Ext;

class Html {

    /**
     * @var array HTML filtering options
     */
    public static $options = array(
        'rx_url' => // URLs over 255 chars can cause problems
        '~^(http|ftp)(s)?\:\/\/((([a-z|0-9|\-]{1,25})(\.)?){2,7})($|/.*$){4,255}$~i',
        'rx_js' => // Questionable attributes
        '/((java)?script|eval|document)/ism',
        'rx_xss' => // XSS (<style> can also be a vector. Stupid IE 6!)
        '/(<(s(?:cript|tyle)).*?)/ism',
        'rx_xss2' => // More potential XSS
        '/(document\.|window\.|eval\(|\(\))/ism',
        'rx_esc' => // Directory traversal/escaping/injection
        '/(\\~\/|\.\.|\\\\|\-\-)/sm',
        'scrub_depth' => 6, // URL Decoding depth (fails on exceeding this)
        'nofollow' => true // Set rel='nofollow' on all links
    );

    /**
     * @var array Whitelist of tags. Trim or expand these as necessary
     * @example 'tag' => array( of, allowed, attributes )
     */
    private static $whitelist = array(
        'p' => array('style', 'class', 'align'),
        'div' => array('style', 'class', 'align'),
        'span' => array('style', 'class'),
        'br' => array('style', 'class'),
        'hr' => array('style', 'class'),
        'h1' => array('style', 'class'),
        'h2' => array('style', 'class'),
        'h3' => array('style', 'class'),
        'h4' => array('style', 'class'),
        'h5' => array('style', 'class'),
        'h6' => array('style', 'class'),
        'strong' => array('style', 'class'),
        'em' => array('style', 'class'),
        'i' => array('style', 'class'),
        'b' => array('style', 'class'),
        'u' => array('style', 'class'),
        'strike' => array('style', 'class'),
        'del' => array('style', 'class'),
        'ol' => array('style', 'class'),
        'ul' => array('style', 'class'),
        'li' => array('style', 'class'),
        'code' => array('style', 'class'),
        'pre' => array('style', 'class'),
        'sup' => array('style', 'class'),
        'sub' => array('style', 'class'),
        // Took out 'rel' and 'title', because we're using those below
        'a' => array('style', 'class', 'href'),
        'img' => array('style', 'class', 'src', 'height',
            'width', 'alt', 'longdesc', 'title',
            'hspace', 'vspace'),
        'table' => array('style', 'class', 'border-collapse',
            'cellspacing', 'cellpadding'),
        'thead' => array('style', 'class'),
        'tbody' => array('style', 'class'),
        'tfoot' => array('style', 'class'),
        'tr' => array('style', 'class'),
        'td' => array('style', 'class',
            'colspan', 'rowspan'),
        'th' => array('style', 'class', 'scope', 'colspan',
            'rowspan'),
        'q' => array('style', 'class', 'cite'),
        'cite' => array('style', 'class'),
        'abbr' => array('style', 'class'),
        'blockquote' => array('style', 'class'),
        // Stripped out
        'body' => array()
    );

    /*     * #@+
     * HTML Filtering
     */

    /**
     * Convert content between code blocks into code tags
     *
     * @param $val string Value to encode to entities
     */
    protected function escapeCode($val) {

        if (is_array($val)) {
            $out = self::entities($val[1]);
            return '<code>' . $out . '</code>';
        }
    }

    /**
     * Convert an unformatted text block to paragraphs
     *
     * @link http://stackoverflow.com/a/2959926
     * @param $val string Filter variable
     */
    protected function makeParagraphs($val) {

        /**
         * Convert newlines to linebreaks first
         * This is why PHP both sucks and is awesome at the same time
         */
        $out = nl2br($val);
        /**
         * Turn consecutive <br>s to paragraph breaks and wrap the
         * whole thing in a paragraph
         */
        $out = '<p>' . preg_replace('#(?:<br\s*/?>\s*?){2,}#', '<p></p><p>', $out) . '</p>';

        /**
         * Remove <br> abnormalities
         */
        $out = preg_replace('#<p>(\s*<br\s*/?>)+#', '</p><p>', $out);
        $out = preg_replace('#<br\s*/?>(\s*</p>)+#', '<p></p>', $out);

        return $out;
    }

    /**
     * Filters HTML content through whitelist of tags and attributes
     *
     * @param $val string Value filter
     */
    public function filter($val, $strict = false, $import = false) {

        if (!isset($val) || empty($val)) {
            return '';
        }

        /**
         * Escape the content of any code blocks before we parse HTML or
         * they will get stripped
         */
        $out = preg_replace_callback("/\<code\>(.*)\<\/code\>/imu", array($this, 'escapeCode'), $val
        );

        /**
         * Convert to paragraphs and begin
         */
        //$out = $this->makeParagraphs($out);
        $dom = new \DOMDocument();

        /**
         * Hide parse warnings since we'll be cleaning the output anyway
         */
        $err = libxml_use_internal_errors(true);

        $html = mb_convert_encoding($out, 'HTML-ENTITIES', "UTF-8");
        $dom->loadHTML($html);
        $dom->encoding = 'utf-8';

        if ($import) {

            //Create new wrapper pre tag
            $pre = $dom->createElement('pre');

            //Find all code tags
            $codes = $dom->getElementsByTagName('code');

            //Iterate though code tags
            foreach ($codes AS $code) {
                //Clone our created div
                $pre_clone = $pre->cloneNode();
                //Replace image with this wrapper div
                $code->parentNode->replaceChild($pre_clone, $code);

                $newdoc = new \DOMDocument();
                $newdoc->preserveWhiteSpace = false;
                $cloned = $code->cloneNode(TRUE);
                $newdoc->appendChild($newdoc->importNode($cloned, TRUE));
                $ht = $newdoc->saveHTML();

                $arr = explode("<code>", $ht);
                $arr2 = explode("</code>", $arr[1]);

                $code->nodeValue = trim($arr2[0]);//$arr2[0];

                //Append this code tag to wrapper div
                $pre_clone->appendChild($code);
            }
        }

        $body = $dom->getElementsByTagName('body')->item(0);
        $this->cleanNodes($body, $badTags, $strict);

        /**
         * Iterate through bad tags found above and convert them to
         * harmless text
         */
        foreach ($badTags as $node) {
            if ($node->nodeName != "#text") {
                $ctext = $dom->createTextNode(
                        $dom->saveHTML($node)
                );
                $node->parentNode->replaceChild(
                        $ctext, $node
                );
            }
        }


        /**
         * Filter the junk and return only the contents of the body tag
         */
        $ht = $dom->saveHTML($body);
        $arr = explode("<body>", $ht);
        $arr2 = explode("</body>", $arr[1]);
        $out = $arr2[0];

        $out = trim($out);

        /**
         * Reset errors
         */
        libxml_clear_errors();
        libxml_use_internal_errors($err);

        return $out;
    }

    protected function cleanAttributeNode(
    &$node, &$attr, &$goodAttributes, &$href
    ) {
        /**
         * Why the devil is an attribute name called "nodeName"?!
         */
        $name = $attr->nodeName;

        /**
         * And an attribute value is still "nodeValue"?? Damn you PHP!
         */
        $val = $attr->nodeValue;

        /**
         * Default action is to remove the attribute completely
         * It's reinstated only if it's allowed and only after
         * it's filtered
         */
        $node->removeAttributeNode($attr);

        if (in_array($name, $goodAttributes)) {

            switch ($name) {

                /**
                 * Validate URL attribute types
                 */
                case 'url':
                case 'src':
                case 'href':
                case 'longdesc':
                    if (self::urlFilter($val)) {

                        //convert absolute path back to relative url
                        $val = str_replace(RURI, "CODOF_RURI_" . UID . "_", $val);
                        $href = $val;
                    } else {
                        $val = '';
                    }
                    break;

                /**
                 * Everything else gets default scrubbing
                 */
                default:
                    if (self::decodeScrub($val)) {
                        $val = self::entities($val);
                    } else {
                        $val = '';
                    }
            }

            if ('' !== $val) {
                $node->setAttribute($name, $val);
            }
        }
    }

    /**
     * Modify links to display their domains and add 'nofollow'.
     * Also puts the linked domain in the title as well as the file name
     */
    protected static function linkAttributes(&$node, $href) {
        try {
            if (!self::$options['nofollow']) {
                return;
            }

            $parsed = parse_url($href);
            
            if(isset($parsed['host'])) {
    
                $title = $parsed['host'] . ' ';
            }            
            else if (isset($parsed['path'])) {
                $f = pathinfo($parsed['path']);
                $title =  $f['basename'];
            }

            $node->setAttribute(
                    'title', $title
            );

            if (self::$options['nofollow']) {
                $node->setAttribute(
                        'rel', 'nofollow'
                );
            }
        } catch (Exception $e) {
            
        }
    }

    /**
     * Iterate through each tag and add non-whitelisted tags to the
     * bad list. Also filter the attributes and remove non-whitelisted ones.
     *
     * @param htmlNode $node Current HTML node
     * @param array $badTags Cumulative list of tags for deletion
     */
    protected function cleanNodes($node, &$badTags = array(), $strict) {

        if (array_key_exists($node->nodeName, self::$whitelist)) {

            if ($node->hasAttributes()) {

                /**
                 * Prepare for href attribute which gets special
                 * treatment
                 */
                $href = '';

                /**
                 * Filter through attribute whitelist for this
                 * tag
                 */
                $goodAttributes = self::$whitelist[$node->nodeName];


                /**
                 * Check out each attribute in this tag
                 */
                foreach (
                iterator_to_array($node->attributes)
                as $attr) {
                    $this->cleanAttributeNode(
                            $node, $attr, $goodAttributes, $href
                    );
                }

                /**
                 * This is a link. Treat it accordingly
                 */
                if ('a' === $node->nodeName && '' !== $href) {
                    self::linkAttributes($node, $href);
                }
            } // End if( $node->hasAttributes() )

            /**
             * If we have childnodes, recursively call cleanNodes
             * on those as well
             */
            if ($node->childNodes) {
                foreach ($node->childNodes as $child) {
                    $this->cleanNodes($child, $badTags, $strict);
                }
            }
        } else {

            /**
             * Not in whitelist so no need to check its child nodes.
             * Simply add to array of nodes pending deletion.
             */
            $badTags[] = $node;
        } // End if array_key_exists( $node->nodeName, self::$whitelist )
    }

    /*     * #@- */

    /**
     * Returns true if the URL passed value is harmless.
     * This regex takes into account Unicode domain names however, it
     * doesn't check for TLD (.com, .net, .mobi, .museum etc...) as that
     * list is too long.
     * The purpose is to ensure your visitors are not harmed by invalid
     * markup, not that they get a functional domain name.
     *
     * @param string $v Raw URL to validate
     * @returns boolean
     */
    public static function urlFilter($v) {

        $v = strtolower($v);
        $out = false;

        $v = htmlspecialchars($v, ENT_QUOTES);

        if (filter_var($v, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
            /**
             * PHP's native filter isn't restrictive enough.
             */
            if (preg_match(self::$options['rx_url'], $v)) {
                $out = true;
            } else {
                $out = false;
            }

            if ($out) {
                $out = self::decodeScrub($v);
            }
        } else if (strpos($v, "/serve/attachment") !== FALSE) {

            $out = urlencode($v); //need improvement here
        } else {

            $out = false;
        }

        return $out;
    }

    /**
     * Regular expressions don't work well when used for validating HTML.
     * It really shines when evaluating text so that's what we're doing here
     *
     * @param string $v string Attribute name
     * @param int $depth Number of times to URL decode
     * @returns boolean True if nothing unsavory was found.
     */
    public static function decodeScrub($v) {
        if (empty($v)) {
            return true;
        }

        $depth = self::$options['scrub_depth'];
        $i = 1;
        $success = false;
        $old = '';


        while ($i <= $depth && !empty($v)) {
            // Check for any JS and other shenanigans
            if (
                    preg_match(self::$options['rx_xss'], $v) ||
                    preg_match(self::$options['rx_xss2'], $v) ||
                    preg_match(self::$options['rx_esc'], $v)
            ) {
                $success = false;
                break;
            } else {
                $old = $v;
                $v = self::utfdecode($v);

                /**
                 * We found the the lowest decode level.
                 * No need to continue decoding.
                 */
                if ($old === $v) {
                    $success = true;
                    break;
                }
            }

            $i++;
        }


        /**
         * If after decoding a number times, we still couldn't get to
         * the original string, then there's something still wrong
         */
        if ($old !== $v && $i === $depth) {
            return false;
        }

        return $success;
    }

    /**
     * UTF-8 compatible URL decoding
     *
     * @link http://www.php.net/manual/en/function.urldecode.php#79595
     * @returns string
     */
    public static function utfdecode($v) {
        $v = urldecode($v);
        $v = preg_replace('/%u([0-9a-f]{3,4})/i', '&#x\\1;', $v);
        return html_entity_decode($v, null, 'UTF-8');
    }

    /**
     * HTML safe character entitites in UTF-8
     *
     * @returns string
     */
    public static function entities($v) {
        return htmlentities(
                iconv('UTF-8', 'UTF-8', $v), ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8'
        );
    }

}
