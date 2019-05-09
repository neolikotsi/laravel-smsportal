<?php

namespace Illuminate\Notifications\Messages;

use NeoLikotsi\SMSPortal\Message;

class SMSPortalMessage extends Message
{
    public function __construct(string $content = '')
    {
        parent::__construct($content);
    }
}
