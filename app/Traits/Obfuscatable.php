<?php

namespace App\Traits;

trait Obfuscatable
{
    public function getObfuscatedIdAttribute(): string
    {
        return $this->getObfuscationPrefix() . $this->encodeId($this->getKey());
    }

    public static function findByObfuscatedId(string $obfuscatedId): ?self
    {
        $prefix = (new static)->getObfuscationPrefix();

        if (!str_starts_with($obfuscatedId, $prefix)) {
            return null;
        }

        $encoded = substr($obfuscatedId, strlen($prefix));
        $id = (new static)->decodeId($encoded);

        return static::find($id);
    }

      protected function encodeId(int $id): string
    {
        $salt = config('services.obfuscation_salt', 93421);
        $mixed = $id ^ $salt;
        return strtoupper(base_convert($mixed, 10, 36));
    }

    protected function decodeId(string $encoded): int
    {
        $salt = config('services.obfuscation_salt', 93421);
        $mixed = base_convert($encoded, 36, 10);
        return $mixed ^ $salt;
    }

    abstract protected function getObfuscationPrefix(): string;

}
