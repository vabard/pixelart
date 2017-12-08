<?php


namespace Entity;
/**
 * Description of Picture
 *
 * @author johandelacasiniere
 */

class Picture {
    
    /**
     * Id of Picture
     * @var int
     */
    private $idPictures;
    
    /**
     * User of Picture
     * @var \Entity\User
     */
    private $User;
    
    /**
     * Canvas
     * @var string
     */
    private $canvas;
    
    /**
     * Png of the canvas
     * @var string
     */
    private $thumb;
    
    /**
     * Category of Picture
     * @var \Entity\Category
     */
    private $category;
}
