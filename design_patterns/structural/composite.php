<?php
/*
 * 组合模式的解决方法是，用抽象类规范统一的对外接口。
 * 然后，让文件类和目录类实现这个接口，并在目录类中递归计算文件的大小。
 * */

/**
 * 规范独立对象和组合对象必须实现的方法，保证它们提供给客户端统一的访问方式
 * 如果独立对象之间有差异的功能，不适合聚合在一起，则不能放在组合类中。
 */
abstract class  Filesystem {
    protected $name;

    //构建函数用于传入文件或目录名称
    public function __construct($name){
        $this->name = $name;
    }

    public abstract function getName();
    public abstract function getSize();
}

/*
 * 目录类是对象集合，通过add()和remove()方法管理文件对象和其他目录对象。
 * 目录类也需要实现抽象类中的方法，以提供给客户端一致性的使用方式。
 * */
class Dir extends Filesystem {
    private $filesystems = [];

    // 组合对象必须实现添加方法。因为传入参数规定为Filesystem类型，
    // 所以目录和文件都能添加
    public function add(Filesystem $filesystem){
        $key = array_search($filesystem, $this->filesystems);
        if($key === false) {
            $this->filesystems[] = $filesystem;
        }
    }

    //组合对象必须实现移除方法
    public function remove(Filesystem $filesystem){
        $key = array_search($filesystem, $this->filesystems);
        if($key !== false){
            unset($this->filesystems[$key]);
        }
    }

    public function getName(){
        return "Dir: " . $this->name . " \n";
    }

    public function getSize() {
        $size = 0;
        foreach ($this->filesystems as $filesystem) {
            $size += $filesystem->getSize();
        }

        return $size;
    }
}

//文件类实现具体的功能，但是没有add()和remove()方法。
/**
 * 独立对象：文本文件类
 */
class TextFile extends Filesystem{
    public function getName() {
        return "Text: ". $this->name ." \n";
    }

    public function getSize() {
        return 10;
    }
}

/*
 * 独立对象2： 图片文件类
 * */
class ImageFile extends Filesystem {
    public function getName() {
        return "Image: ". $this->name;
    }

    public function getSize() {
        return 100;
    }
}

/*
 * 独立对象： 视频文件
 * */
class VideoFile extends Filesystem {
    public function getName() {
        return "Video: " . $this->name;
    }

    public function getSize() {
        return 200;
    }
}

//客户端代码
$dir = new Dir('D:\go-project\temp');
$dir->add(new TextFile('test.txt'));
$dir->add(new TextFile('test_copy.txt'));
$dir->add(new ImageFile('curl.jpg'));

//子目录
$subDir = new Dir('source');
$dir->add($subDir);
$text2 = new TextFile('text2.txt');
$subDir->add($text2);

echo $text2->getName(). '--->'. $text2->getSize();
echo $subDir->getName(). '--->'. $subDir->getSize();
echo $dir->getName(). '--->'. $dir->getSize();