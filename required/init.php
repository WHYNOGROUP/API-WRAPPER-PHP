<?php
# GNU LESSER GENERAL PUBLIC LICENSE
# Version 3, 29 June 2007
#
# Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
# Everyone is permitted to copy and distribute verbatim copies
# of this license document, but changing it is not allowed.
# WHYNOGROUP - WNG - WNL - WNA - WNH - WNR - WNC
# 2018-06-09 - https://api.whyno.group
/**
 * Utility to intialize Api Request
 *
 */

 /**
  * Include wng.class.php
  */
  require ('wng.class.php');

  /**
   * Contains your consumer key
   *
   * @var string
   */
  $consumerKey = 'your_consumer_key';

  /**
   * Create new instance of Api
   */
  $wng = new wng($consumerKey);
