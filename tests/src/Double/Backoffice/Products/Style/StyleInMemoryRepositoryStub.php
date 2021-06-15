<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Style;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;

final class StyleInMemoryRepositoryStub
{
    public static function empty(): StyleRepository
    {
        return self::repository([]);
    }

    private static function repository(array $crmData): StyleRepository
    {
        return (
        new class($crmData) implements StyleRepository
        {
            private ArrayCollection $arrayCollection;

            public function __construct(?array $crmData)
            {
                $this->arrayCollection = new ArrayCollection($crmData);
            }

            public function save(Style $style): void
            {
                if ($this->arrayCollection->contains($style)) {
                    $this->arrayCollection->removeElement($style);
                    $this->arrayCollection->add($style);
                } else {
                    $this->arrayCollection->add($style);
                }
            }

            public function findByName(StyleName $styleName): ?Style
            {
                $filter = $this->arrayCollection->filter(
                    function (Style $style) use ($styleName) {

                        return  (string)$style->name() == $styleName;
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function find(StyleId $id): ?Style
            {
                $filter = $this->arrayCollection->filter(
                    function (Style $style) use ($id) {
                        return $style->id()->equals($id);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function remove(Style $style): void
            {
                $this->arrayCollection->removeElement($style);
            }


            public function findBy(StyleId $id): ?Style
            {
                $filter = $this->arrayCollection->filter(
                    function (Style $style) use ($id) {
                        return $style->id()->equals($id);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }
        }
        );
    }
}