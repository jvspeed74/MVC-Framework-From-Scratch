<?php
namespace PhpWebFramework\core;
/**
 * Abstract class Controller
 *
 * Base class for controllers responsible for handling requests and coordinating with models and views.
 */
abstract class Controller
{
    /**
     * @var object|null The model instance associated with the controller.
     */
    protected ?object $model = null;
    protected ?SessionManager $session = null;
    
}
