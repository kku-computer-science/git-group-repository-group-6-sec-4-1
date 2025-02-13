<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

class Escher
{
    /**
     * Drawing Group Container.
     *
<<<<<<< HEAD
     * @var Escher\DggContainer
=======
     * @var ?Escher\DggContainer
>>>>>>> main
     */
    private $dggContainer;

    /**
     * Drawing Container.
     *
<<<<<<< HEAD
     * @var Escher\DgContainer
=======
     * @var ?Escher\DgContainer
>>>>>>> main
     */
    private $dgContainer;

    /**
     * Get Drawing Group Container.
     *
<<<<<<< HEAD
     * @return Escher\DggContainer
=======
     * @return ?Escher\DggContainer
>>>>>>> main
     */
    public function getDggContainer()
    {
        return $this->dggContainer;
    }

    /**
     * Set Drawing Group Container.
     *
     * @param Escher\DggContainer $dggContainer
     *
     * @return Escher\DggContainer
     */
    public function setDggContainer($dggContainer)
    {
        return $this->dggContainer = $dggContainer;
    }

    /**
     * Get Drawing Container.
     *
<<<<<<< HEAD
     * @return Escher\DgContainer
=======
     * @return ?Escher\DgContainer
>>>>>>> main
     */
    public function getDgContainer()
    {
        return $this->dgContainer;
    }

    /**
     * Set Drawing Container.
     *
     * @param Escher\DgContainer $dgContainer
     *
     * @return Escher\DgContainer
     */
    public function setDgContainer($dgContainer)
    {
        return $this->dgContainer = $dgContainer;
    }
}
