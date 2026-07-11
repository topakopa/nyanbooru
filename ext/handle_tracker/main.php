<?php

declare(strict_types=1);

namespace Shimmie2;

// TODO: Add support for generating an icon from embedded cover art
// TODO: MORE AUDIO FORMATS

class TrackerFileHandler extends DataHandlerExtension
{
    public const KEY = "handle_tracker";
    public const SUPPORTED_MIME = [MimeType::XMOD];

    protected function media_check_properties(Post $image): MediaProperties
    {
        // TODO: ->length = ???

        return new MediaProperties(
            width: 0,
            height: 0,
            lossless: true,
            video: false,
            audio: true,
            image: false,
            video_codec: null,
        );
    }

    protected function create_thumb(Post $image): bool
    {
        $outname = $image->get_thumb_filename();
        (new Path("ext/handle_tracker/thumb.jpg"))->copy($outname);
        return true;
    }

    protected function check_contents(Path $tmpname): bool
    {
        $mime = MimeType::get_for_file($tmpname)->base;
        return in_array($mime, self::SUPPORTED_MIME);
    }
}
