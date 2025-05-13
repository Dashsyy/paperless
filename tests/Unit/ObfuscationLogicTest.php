<?php

namespace Tests\Unit;

use App\Models\Seeker;
use PHPUnit\Framework\TestCase;

class ObfuscationLogicTest extends TestCase
{
    public function test_seeker_obfuscation_is_reversible()
    {
        config()->set('services.obfuscation_salt', 93421);

        $seeker = Seeker::factory()->create();
        $obfuscated = $seeker->obfuscated_id;

        $resolved = Seeker::findByObfuscatedId($obfuscated);
        $this->assertEquals($seeker->id, $resolved->id);
    }

    public function test_invalid_obfuscated_id_returns_null()
    {
        config()->set('services.obfuscation_salt', 93421);

        $resolved = Seeker::findByObfuscatedId('se_1');
        $this->assertNull($resolved);
    }
}
