<?php

declare(strict_types=1);

class PostPeekInfo extends ExtensionInfo
{
    public const KEY = "post_peek";

    public string $key = self::KEY;
    public string $name = "Post Peek";
    public string $url = self::SHIMMIE_URL;
    public array $authors = ["Matthew Barbour"];
    public string $license = self::LICENSE_WTFPL;
    public string $description = "Peek at posts";
}
