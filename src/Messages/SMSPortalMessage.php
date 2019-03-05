<?php

namespace Illuminate\Notifications\Messages;

class SMSPortalMessage
{
    public const LINE_BREAK = '|';

    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * Create a new message instance.
     *
     * @param  string  $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }
}
