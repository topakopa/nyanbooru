<?php

declare(strict_types=1);

namespace Shimmie2;

class TrackerFileHandlerInfo extends ExtensionInfo
{
    public const KEY = "handle_tracker";

    public string $name = "Tracker Files";
    public array $authors = self::SHISH_AUTHOR;
    public ExtensionCategory $category = ExtensionCategory::FORMAT_SUPPORT;
    public string $description = "Handle MOD, IT, XM files";
}
