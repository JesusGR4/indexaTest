<?php
        //Enter your code here, enjoy!
class Block {
    public $id;
    public $orientation;
    public $leftPoint;
    public $rightPoint;
    public $length;

    public function __construct($id, $orientation, $x, $y, $length){
        $this->id = $id;
        $this->orientation = $orientation;
        $this->leftPoint = new Point($x, $y);
        $this->rightPoint = new Point($x, $y, $length, $orientation);
        $this->length = $length;
    }
    /*
    * Comprobamos si los dos bloques se superponen
    */
    public static function checkIfOverlaps($redBlock, $blueBlock){
        $p1 = $redBlock->leftPoint;
        $q1 = $redBlock->rightPoint;
        $p2 = $blueBlock->leftPoint;
        $q2 = $blueBlock->rightPoint;
        return self::checkIntersect($p1, $q1, $p2, $q2);
    }
    /**
     * Comprobamos si el punto q está entre p y r
     */
    public static function checkSegment($p, $q, $r){
        if ($q->x <= max($p->x, $r->x) && $q->x >= min($p->x, $r->x) && $q->y <= max($p->y, $r->y) && $q->y >= min($p->y, $r->y)) return true;
        return false;
    } 
    
    /**
     * Comprobamos si ambos están en la misma dirección o no
     */
    public static function orientation($p, $q, $r){
    $val = ($q->y - $p->y) * ($r->x - $q->x) - ($q->x - $p->x) * ($r->y - $q->y);
 
    if ($val == 0) return 0; 
 
    return ($val > 0)? 1: 2; 
        
    }
    
    public static function checkIntersect($p1, $q1, $p2, $q2){
        $o1 = self::orientation($p1, $q1, $p2);
        $o2 = self::orientation($p1, $q1, $q2);
        $o3 = self::orientation($p2, $q2, $p1);
        $o4 = self::orientation($p2, $q2, $q1);
    
        if ($o1 != $o2 && $o3 != $o4)
            return 'intersect';
     
        if ($o1 == 0 && self::checkSegment($p1, $p2, $q1)) return 'intersect';
     
        if ($o2 == 0 && self::checkSegment($p1, $q2, $q1)) return 'intersect';
     
        if ($o3 == 0 && self::checkSegment($p2, $p1, $q2)) return 'intersect';
     
        if ($o4 == 0 && self::checkSegment($p2, $q1, $q2)) return 'intersect';
     
        return 'do not intersect'; 
        
        
    }
    
    
}

class Point {
    public $x;
    public $y;
    
    public function __construct($x, $y, $length = null, $orientation = null){
        switch($orientation){
            case 'h':
                $this->x = $x+($length-1);
                $this->y = $y;
                break;
            case 'v':
                $this->x = $x;
                $this->y = $y+($length-1);
                break;
            default:
                $this->x = $x;
                $this->y = $y;
                break;
        }
    }
}

$redBlock = new Block(0, 'h', 2,3,5);
$blueBlock = new Block(1, 'v', 3,1,1);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));
//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 2,3,1);
$blueBlock = new Block(1, 'h', 2,3,1);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 2,3,5);
$blueBlock = new Block(1, 'h', 3, 3, 2);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 2,3,5);
$blueBlock = new Block(1, 'h', 4,1,2);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 2,3,5);
$blueBlock = new Block(1, 'v', 3,1,3);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 8,7,2);
$blueBlock = new Block(1, 'v', 10,7,6);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 2,3,5);
$blueBlock = new Block(1, 'v', 3,1,2);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 4,3,3);
$blueBlock = new Block(1, 'v', 6,2,2);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'v', 3,3,2);
$blueBlock = new Block(1, 'v', 3,5,2);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));

//===========================================================================================
echo ' || ';
$redBlock = new Block(0, 'h', 1,3,2);
$blueBlock = new Block(1, 'h', 5,3,2);
print_r(Block::checkIfOverlaps($redBlock, $blueBlock));