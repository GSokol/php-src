--TEST--
Bug #71835 (json_encode sometimes incorrectly detects recursion with JsonSerializable)
--SKIPIF--
<?php if (!extension_loaded("json")) print "skip"; ?>
--FILE--
<?php
class SomeClass implements JsonSerializable {
	public function jsonSerialize() {
		return [get_object_vars($this)];
	}
}
$class = new SomeClass;
$arr = [$class];
var_dump(json_encode($arr));
?>
--EXPECT--
string(6) "[[[]]]"
