<?php
class DogsTest extends PHPUnit_Extensions_Database_TestCase
{
    // Helper function: compare
    public function assertResultArraysEqual($expected, $actual) {
        // Testing framework provides a very powerful comparing function to
        // play with!
        $this->assertEquals($expected, $actual);
    }

    // @override
    // Provides the connection for the framework that will truncate and
    // re-initialize the tables.
    public function getConnection()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        return $this->createDefaultDBConnection($pdo, 'test');
    }

    // @override
    // The framework will truncate the database and use the data-set provided
    // by this function to initialize the db, to set the starting point of the
    // test to be in a KNOWN state.
    public function getDataSet()
    {
        $ret = $this->createFlatXMLDataSet(dirname(__FILE__).'/_files/dogs-seed.xml'); // Init from a file!
        return $ret;
    }

    // This testing is demonstrating the fixtures will be reset before each
    // test case!
    // Even though this test case inserted a row to 'owners', but will not
    // affect the other test case.
    public function testInserting() {
        $this->getConnection()->getConnection()->exec("INSERT INTO `owners` (`name`, `email`) VALUES ('Donald Trump', 'idont@know.com');");
    }

    public function testFindDogsThatCouldBeContactedByEmail() {
        // Put the database operations here and retrieve a result you want to
        // compare against the EXPECTED.
        $dataSet = $this->getConnection()->getConnection()->query('SELECT dogs.name, owners.email FROM dogs JOIN owners ON dogs.owner=owners.name')->fetchAll(PDO::FETCH_ASSOC);

        // Put the expected data-set in sequence
        $expectedDataSet = [
            [ 'name'=>'Bailey', 'email'=>'hrod17@clintonemail.com' ],
            [ 'name'=>'Buddy', 'email'=>'hrod17@clintonemail.com' ]
        ];

        // Comparing
        $this->assertResultArraysEqual($expectedDataSet, $dataSet);
    }
}
?>
