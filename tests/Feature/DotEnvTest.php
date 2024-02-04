<?php
use Pkit\DotEnv;

test('not load env', function () {
    expect(DotEnv::load('.env.false'))->toBeFalse();
});

test('load simple env', function () {
    expect(DotEnv::load('.env.simple'))->toBeTrue();
    expect(getenv('A'))->toEqual("abcde1234");
    expect(getenv('B'))->toEqual("2");
    expect(getenv('C'))->toEqual("true");
    expect(getenv('D'))->toEqual("");
});

test('load comented env', function () {
    expect(DotEnv::load('.env.comented'))->toBeTrue();
    expect(getenv('E'))->toEqual("abcde1234");
    expect(getenv('COMENTED'))->toBeFalse();
    expect(getenv('G'))->toEqual("true#false");
    expect(getenv('H'))->toEqual("");
});