<?php
/**
 * @file LogoListTest.php
 * Replace with one line description.
 */
namespace Cxj;

use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;


class LogoListTest extends TestCase
{
    use PHPMock;


    public function testConstructor(): void
    {
        $stub = $this->createStub("Directory");
        $stub->method("read")
             ->willReturnOnConsecutiveCalls("file1", "file2", false);

        $dir = $this->getFunctionMock(__NAMESPACE__, "dir");
        $dir->expects($this->once())->willReturn($stub);

        $is_file = $this->getFunctionMock(__NAMESPACE__, "is_file");
        $is_file->expects($this->any())->willReturn(true);

        $is_readable = $this->getFunctionMock(__NAMESPACE__, "is_readable");
        $is_readable->expects($this->any())->willReturn(true);

        $logoList = new LogoList();
        $this->assertInstanceOf(LogoList::class, $logoList);
    }
}
