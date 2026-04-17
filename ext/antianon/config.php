<?php

declare(strict_types=1);

namespace Shimmie2;

final class AntianonConfig extends ConfigGroup
{
    public const KEY = "antianon";

    #[ConfigMeta("Disable anon access", ConfigType::BOOL, default: false)]
    public const ANTIANON = "antianon";

    #[ConfigMeta("Message for anons", ConfigType::STRING, input: ConfigInput::TEXTAREA, default: "The site is currently down for maintenance.")]
    public const MESSAGE = "antianon_message";
}
