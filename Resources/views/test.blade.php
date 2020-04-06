@extends('block@block')

@section('inner')
<h1>Hello, I'm a system block, defined by a class and I'm very boring</h1>
<h2>There is {{ $users }} users on the system</h2>
@overwrite