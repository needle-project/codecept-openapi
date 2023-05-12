<?php
namespace NeedleProject\CodeceptOpenAPI;

use cebe\openapi\spec\MediaType;
use cebe\openapi\spec\OpenApi;
use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Response;
use cebe\openapi\SpecObjectInterface;
use Codeception\Module;
use cebe\openapi\Reader;
use NeedleProject\CodeceptOpenAPI\Dto\Path;
use NeedleProject\CodeceptOpenAPI\Dto\PathDto;

class OpenAPIModule extends Module
{
    /** @var array */
    protected array $config = [
        'schema' => null,
    ];

    private $openAPISchema = null;

    /**
     * HOOK:
     * triggered after module is created and configuration is loaded
     */
    public function _initialize()
    {
        // ...
    }

    private function getSchema(): OpenApi
    {
        if (is_null($this->openAPISchema)) {
            $tmpSchema = Reader::readFromYamlFile(
                codecept_root_dir() . DIRECTORY_SEPARATOR . $this->config['schema']
            );
            if (!$tmpSchema->validate()) {
                throw new \RuntimeException("OpenAPI Schema is invalid!");
            }
            $this->openAPISchema = $tmpSchema;
        }
        return $this->openAPISchema;
    }

    /**
     * Get Path Keys
     * @return array
     */
    public function getPathKeys(): array
    {
        return array_keys($this->getSchema()->paths->getPaths());
    }

    public function getPath($key)
    {
        $path = $this->getSchema()->paths->getPath($key);

        $responses = [];

        $operations = $path->getOperations();
        /** @var Operation $operation */
        foreach ($operations as $index => $operation) {
#            dump($key);
#            dump($index);
#            dump($operation->requestBody);
            /** @var Response $response */
            foreach ($operation->responses as $key => $response) {
                /** @var MediaType $block */
                foreach ($response->content as $index => $block) {
                    $responses[] = new \NeedleProject\CodeceptOpenAPI\Dto\Response(
                        (int)$index,
                        ''
                    );
                    dump($block->schema->getSerializableData());

                    #dump(get_class($block));
                }
                #$content = $response->content;

                #dump($content->example);
                #dump($response->content)

                #dump($response->getSerializableData());
            }
        }
        #dump($path->getOperations());
        #dump(get_class($path));
        #dump($path);

        return new Path($responses);
    }
}
