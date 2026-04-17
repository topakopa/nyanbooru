<?php

declare(strict_types=1);

namespace Shimmie2;

final class AntianonInfo extends ExtensionInfo
{
    public const KEY = "antianon";

    public string $name = "Antianon";
    public array $authors = self::SHISH_AUTHOR;
    public ExtensionCategory $category = ExtensionCategory::ADMIN;
    public string $description = "Locks site from anons";
    public ?string $documentation =
        "Once installed there will be some more options on the config page --
Ticking \"disable anon access\" will mean that regular and anonymous
users will be blocked from accessing the site, only able to view the
message specified in the box.";
}
