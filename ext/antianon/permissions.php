<?php

declare(strict_types=1);

namespace Shimmie2;

final class AntianonPermission extends PermissionGroup
{
    public const KEY = "antianon";

    #[PermissionMeta("Ignore Antianon", help: "These users can still access the site during lockdown")]
    public const IGNORE_ANTIANON = "ignore_antianon";
}
