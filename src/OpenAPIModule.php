<?php
namespace NeedleProject\CodeceptOpenAPI;
class OpenAPIModule extends \Codeception\Module
{

    /** @var array */
    protected $config = [
        'foo' => true,
    ];

    /**
     * HOOK:
     * triggered after module is created and configuration is loaded
     */
    public function _initialize()
    {
        // ...
    }
}
