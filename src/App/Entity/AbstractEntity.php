<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Proxy\Proxy;
use Zend\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity
 * @package Application\Entity
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{
    /**
     * @var OauthUsers
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\OauthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="username", nullable=false)
     * })
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var OauthUsers
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\OauthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="username", nullable=true)
     * })
     */
    private $updatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * AbstractEntity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if ($data) {
            $hydrator = new ClassMethods();
            $hydrator->hydrate($data, $this);
        }
    }

    /**
     * @return OauthUsers
     */
    public function getCreatedBy(): OauthUsers
    {
        return $this->createdBy;
    }

    /**
     * @param OauthUsers $createdBy
     */
    public function setCreatedBy(OauthUsers $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return OauthUsers
     */
    public function getUpdatedBy(): ?OauthUsers
    {
        return $this->updatedBy;
    }

    /**
     * @param OauthUsers $updatedBy
     */
    public function setUpdatedBy(OauthUsers $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param array $classes
     * @return array
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \ReflectionException
     */
    public function toArray($classes = [])
    {
        $result = [];
        $class = get_class($this);
        $reader = new AnnotationReader();

        if ($this instanceof Proxy) {
            $class = get_parent_class($this);
        }
        $classes[] = $class;

        $propertiesClass = $this->getProperties($class);
        $propertiesAbstract = $this->getProperties(AbstractEntity::class);
        $properties = array_merge($propertiesClass, $propertiesAbstract);

        foreach ($properties as $property) {
            $annotations = $reader->getPropertyAnnotations($property);
            foreach ($annotations as $annotation) {
                if ($annotation instanceof ManyToMany) {
                    continue;
                }

                if ($annotation instanceof OneToMany) {
                    if ($annotation->mappedBy) {
                        continue;
                    }
                    $result[$property->name] = $this->getValueOneToMany($property->name, $this, $classes);
                    continue;
                }

                if ($annotation instanceof ManyToOne &&
                    (!in_array($annotation->targetEntity, $classes))
                ) {
                    $result[$property->name] = $this->getValueManyToOne($property->name, $this);
                    continue;
                }

                if ($annotation instanceof OneToOne) {
                    $result[$property->name] = $this->getValueOneToOne($property->name, $this);
                    continue;
                }

                if ($annotation instanceof Column) {
                    $result [$property->name] = $this->getValueProperty($property->name, $this);
                    continue;
                }
            }
        }

        return $result;
    }

    /**
     * @param $name
     * @param $object
     * @return array
     * @throws \Exception
     */
    private function getValueManyToOne($name, $object)
    {
        $method = $this->getNameMethod($name, $object);
        $result = $object->$method();

        if (!$result) {
            return [];
        }

        return $result->toArray();
    }

    /**
     * @param $name
     * @param $object
     * @return array
     * @throws \Exception
     */
    private function getValueOneToOne($name, $object)
    {
        $method = $this->getNameMethod($name, $object);
        $result = $object->$method();

        if (!$result) {
            return [];
        }

        return $result->toArray();
    }

    /**
     * @param $mapped
     * @param $object
     * @param array $classes
     * @return array
     * @throws \Exception
     */
    private function getValueOneToMany($mapped, $object, array $classes)
    {

        $result = [];
        $method = $this->getNameMethod($mapped, $object);

        /** @var Collection $collection */
        $collection = $object->$method();

        if (!$collection instanceof Collection) {
            return $result;
        }

        foreach ($collection as $item) {
            $result[] = $item->toArray($classes);
            continue;
        }

        return $result;
    }

    /**
     * @param $name
     * @param $object
     * @return mixed
     * @throws \Exception
     */
    private function getValueProperty($name, $object)
    {
        $method = $this->getNameMethod($name, $object);

        if ($object->$method() instanceof \DateTime) {
            return $object->$method()->format('d/m/Y H:i:s');
        }

        return $object->$method();
    }

    /**
     * @param $name
     * @param $object
     * @return string
     * @throws \Exception
     */
    private function getNameMethod($name, $object)
    {
        $method = 'get' . ucfirst($name);
        if (!method_exists(get_class($object), $method)) {
            $method = 'is' . ucfirst($name);
            if (!method_exists(get_class($object), $method)) {
                throw new \Exception('Metodo ' . $method . ' nao existe, Objeto: ' . get_class($object), 99);
            }
        }
        return $method;
    }

    /**
     * @param $class
     * @return \ReflectionProperty[]
     * @throws \ReflectionException
     */
    private function getProperties($class)
    {

        $reflector = new \ReflectionClass($class);
        $properties = $reflector->getProperties();

        return $properties;
    }
}