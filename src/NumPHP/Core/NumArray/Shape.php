<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 11/26/14
 * Time: 7:36 AM
 */

namespace NumPHP\Core\NumArray;

use NumPHP\Core\Exception\InvalidArgumentException;

/**
 * Class Shape
 * @package NumPHP\Core\NumArray
 */
class Shape
{
    /**
     * @param $data
     * @return array
     */
    public static function getShape($data)
    {
        $shape = [];
        return self::getShapeRecursive($data, $shape);
    }

    /**
     * @param $data
     * @param $shape
     * @param int $level
     * @return array
     */
    protected static function getShapeRecursive($data, $shape, $level = 0)
    {
        if (is_array($data)) {
            $count = count($data);
            if (isset($shape[$level]) && $shape[$level] !== $count) {
                throw new InvalidArgumentException('Dimensions did not match');
            } else {
                $shape[$level] = $count;
            }
            foreach ($data as $row) {
                $shape = self::getShapeRecursive($row, $shape, $level+1);
            }
        }
        return $shape;
    }
}
