<?php
abstract class AbstractController {

    //! Propriétés
    private ViewHeader $header;
    private ViewFooter $footer;
    private InterfaceModel $model;
    public function __construct(ViewHeader $header, ViewFooter $footer, InterfaceModel $model) {
        $this->header = $header;
        $this->footer = $footer;
        $this->model = $model;
    }

    //! Getters & Setters
    /**
     * Get the value of header
     *
     * @return ViewHeader
     */
    public function getHeader(): ViewHeader {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @param ViewHeader $header
     *
     * @return self
     */
    public function setHeader(ViewHeader $header): self {
        $this->header = $header;
        return $this;
    }

    /**
     * Get the value of footer
     *
     * @return ViewFooter
     */
    public function getFooter(): ViewFooter {
        return $this->footer;
    }

    /**
     * Set the value of footer
     *
     * @param ViewFooter $footer
     *
     * @return self
     */
    public function setFooter(ViewFooter $footer): self {
        $this->footer = $footer;
        return $this;
    }

    /**
     * Get the value of model
     *
     * @return InterfaceModel
     */
    public function getModel(): InterfaceModel {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param InterfaceModel $model
     *
     * @return self
     */
    public function setModel(InterfaceModel $model): self {
        $this->model = $model;
        return $this;
    }

    //! Méthodes

    abstract public function render(): void;
}