<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Recruit;

use App\Controller\Recruit\DivisionController;
use Cake\Http\ServerRequest;
use Cake\TestSuite\TestCase;

class DivisionControllerTest extends TestCase
{
    public function testRenderApprovalLetterUsesA4PageLayout(): void
    {
        $request = new ServerRequest([
            'environment' => [
                'HTTP_HOST' => 'localhost',
                'HTTPS' => 'off',
            ],
        ]);

        $controller = new DivisionController($request);
        $reflection = new \ReflectionMethod(DivisionController::class, 'renderApprovalLetterViewContent');
        $reflection->setAccessible(true);

        $html = $reflection->invoke($controller, [
            'targetQRPath' => '',
        ]);

        $this->assertStringContainsString('size: A4 portrait', $html);
        $this->assertStringContainsString('@font-face', $html);
        $this->assertStringContainsString('NotoDevanagari', $html);
        $this->assertStringContainsString('file:///', $html);
        $this->assertStringContainsString('<div class="letter-page">', $html);
        $this->assertStringContainsString("</div>\n            </body>", $html);
    }
}
