<?php
class Book {
    public $title;
    public $author;
    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }
    public function displayInfo() {
        echo "Title: " . $this->title . "\n";
        echo "Author: " . $this->author . "\n";
    }
}
$book1 = new Book("1984<br>", "George Orwell <br><br>");
$book2 = new Book("To Kill a Mockingbird <br>", "Harper Lee");
echo "Book 1:\n<br>";
$book1->displayInfo();
echo "\n";
echo "Book 2:\n<br>";
$book2->displayInfo();
echo "<pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>";
?>