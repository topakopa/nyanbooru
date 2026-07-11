<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\{DIV, STRONG, A, BR, SPAN, INPUT, SMALL, SCRIPT, emptyHTML};

class TrackerFileHandlerTheme extends Themelet
{
    public function build_media(Post $image): \MicroHTML\HTMLElement
    {
        global $page;
        $ilink = $image->get_media_link();
        $iname = $image->filename;
        $isize = sprintf('%.02F', $image->filesize / pow(1024, floor(log($image->filesize) / log(1024)))) * 1 . ' ' . array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB')[floor(log($image->filesize) / log(1024))];

   //      $html = "
			// <strong><a href=\"javascript:pauseButton()\" id=\"play\">Play</a></strong>
			// <br>
			// <span id=\"modfilename\">$iname</span>
			// <br>
			// Название: <span id=\"audio-title\">Без названия</span>
			// <br>
			// Продолжительность: <span id=\"audio-duration\">0:00</span> <input id=\"audio-seekbar\" type=\"range\" min=\"0\" max=\"225.7920000000034\" value=\"0\" onchange=\"player.seek(this.value);\">
			// <br>
			// Размер: $isize
			// <br>
			// <a href='$ilink' id='audio-download'>Скачать</a>
			// <br>
			// <small id=\"library-version\">Library version: libopenmpt</small>
			// <br>
			// <div class=\"reply\" style=\"display: none;\">Внутрений текст: <span id=\"modmessage\"></span></div>
   //
			// ";

        $page->add_html_header(SCRIPT(['src' => '/ext/handle_tracker/lib/chiptune2.js', 'type' => 'text/javascript']));
        // $page->add_html_header(SCRIPT(['type' => 'text/javascript'], ""));
        $page->add_html_header(SCRIPT(['src' => '/ext/handle_tracker/lib/script.js', 'type' => 'text/javascript']));
        $page->add_html_header(SCRIPT(['src' => '/ext/handle_tracker/lib/libopenmpt.js', 'type' => 'text/javascript', 'async' => '', 'onload' => 'initPlayer();']));

        return emptyHTML(
            STRONG(
                A(['id' => 'play', 'href' => 'javascript:pauseButton()'], "Играть")
            ),
            BR(),
            SPAN(['id' => 'modfilename'], $iname),
            BR(),
            "Название: ", SPAN(['id' => 'audio-title'], "Без названия"),
            BR(),
            "Продолжительность: ", SPAN(['id' => 'audio-duration'], "0:00"), INPUT(['id' => 'audio-seekbar', 'type' => 'range', 'min' => '0', 'max' => '225.7920000000034', 'value' => '0', 'onchange' => 'player.seek(this.value);']),
            BR(),
            "Размер: ", $isize,
            BR(),
            A(['id' => 'audio-download', 'href' => $ilink], "Скачать"),
            BR(),
            SMALL(['id' => 'library-version'], "Library version: Loading..."),
            BR(),
            DIV(['class' => 'reply', 'style' => 'display: none;'], "Внутрений текст: ", SPAN(['id' => 'modmessage']))
        );
    }
}
