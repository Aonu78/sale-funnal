@extends('layouts.app')

@section('title', 'Submissions')

@section('content')
<div class="card">
    <h1>Submissions</h1>

    <form method="GET" class="mt">
        <div class="row">
            <select name="funnel_id">
                <option value="">All Funnels</option>
                @foreach($funnels as $f)
                    <option value="{{ $f->id }}" {{ request('funnel_id')==$f->id?'selected':'' }}>
                        {{ $f->title }}
                    </option>
                @endforeach
            </select>

            <select name="answer">
                <option value="">Any Answer</option>
                <option value="yes" {{ request('answer')=='yes'?'selected':'' }}>Yes</option>
                <option value="no" {{ request('answer')=='no'?'selected':'' }}>No</option>
            </select>
        </div>

        <div class="row mt">
            <input type="date" name="from" value="{{ request('from') }}">
            <input type="date" name="to" value="{{ request('to') }}">
        </div>

        <input class="mt" type="text" name="search" placeholder="Search name/email/phone" value="{{ request('search') }}">

        <button class="btn mt" type="submit">Apply Filters</button>
    </form>

    <div class="mt">
        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
            <thead>
            <tr style="background:#eee">
                <th align="left">Date</th>
                <th align="left">Funnel</th>
                <th align="left">Name</th>
                <th align="left">Email</th>
                <th align="left">Phone</th>
                <th align="left">Answer</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissions as $s)
                <tr style="border-top:1px solid #ddd">
                    <td>{{ $s->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $s->funnel->title }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->phone }}</td>
                    <td>{{ $s->question_answer }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt">
            {{ $submissions->links() }}
        </div>
    </div>
</div>
@endsection
