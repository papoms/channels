<?php

namespace NotificationChannels\Signal;

use Illuminate\Support\Arr;

class SignalMessage
{
    /**
    * The phone number messages will be sent from.
    * Must include prefix ("+") and country code.
    *
    * @var string
    **/
    public $username;

    /**
    * The message content.
    *
    * @var string
    **/
    public $message;

    /**
    *
    * The phone number of the recipient.
    * Must include prefix ("+") and country code.
    *
    * @var string
    **/
    public $recipient;

    /**
    *
    * The group to send to
    * can be found with signal-cli listGroups
    * example "Hwi6toUb6T5Xa63e8Dc21PqfE3kCxTO0FIR8hZbClkM="
    *
    * @var string
    **/
    public $group;

     /**
    *
    * The attachement to be send
    *
    * @var string
    **/
    public $attachment;

    /**
    * Create a new message instance.
    *
    * @param  string $message
    *
    * @return static string
    */
    // public static function create(string $message = '')
    // {
    //   return new static($message);
    // }

    /**
    * Create a new message instance.
    *
    * @param  string  $message
    */
    public function __construct($message = '')
    {
      $this->message = $message;
    }

    /**
    * Set the message.
    *
    * @param  string  $message
    *
    * @return $this
    */
    public function message(string $message)
    {
      $this->message = $message;

      return $this;
    }

    /**
    * Set the phone number the message should be sent to.
    *
    * @param  string  $recipient
    *
    * @return $this
    */
    public function recipient(string $recipient)
    {
      $this->recipient = $recipient;

      return $this;
    }

     /**
    * Set the Group ID the message should be sent to.
    *
    * @param  string  $group
    *
    * @return $this
    */
    public function group(string $group)
    {
      $this->group = $group;

      return $this;
    }

     /**
    * Set the username the message should be sent from.
    *
    * @param  string  $group
    *
    * @return $this
    */
    public function username(string $username)
    {
      $this->username = $username;

      return $this;
    }

     /**
    * Set the username the message should be sent from.
    *
    * @param  string  $group
    *
    * @return $this
    */
    public function attachment(string $attachment)
    {
      $this->attachment = $attachment;

      return $this;
    }

}
