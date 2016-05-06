<?php

namespace RETROG\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RETROGUserBundle extends Bundle
{
	  public function getParent()
	  {
	    return 'FOSUserBundle';
	  }
}
