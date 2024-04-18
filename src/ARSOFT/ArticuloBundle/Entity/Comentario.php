<?php

namespace ARSOFT\ArticuloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comentario
 *
 * @ORM\Table(name="comentario")
 * @ORM\Entity
 */
class Comentario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $autor;

    /** @ORM\Column(type="text") */
    protected $contenido;

    /** @ORM\Column(type="integer") */
    protected $respuesta;

    /**
     * @ORM\ManyToOne(targetEntity="Articulo")
     * @ORM\JoinColumn(name="articulo_id", referencedColumnName="id")
     */
    protected $articulo;

    public function setAutor($autor)
    {
        $this->autor = $autor;
        return $this;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setArticulo(\ARSOFT\ArticuloBundle\Entity\Articulo $articulo = null)
    {
        $this->articulo = $articulo;
        return $this;
    }

    public function getArticulo()
    {
        return $this->articulo;
    }

    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
        return $this;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
        return $this;
    }

    public function getRespuesta()
    {
        return $this->respuesta;
    }

}
