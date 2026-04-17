<?php

declare(strict_types=1);

namespace Shimmie2;

final class WebampInfo extends ExtensionInfo
{
    public const KEY = "webamp";

    public string $name = "Webamp";
    public array $authors = ["TOPa" => ""];
    public string $description = "Replaces basic player with Webamp";
    public ExtensionCategory $category = ExtensionCategory::GENERAL;
    public ?string $documentation = "Webamp itself is licensed under MIT.";
    public ?string $link = "https://github.com/captbaritone/webamp";
}
