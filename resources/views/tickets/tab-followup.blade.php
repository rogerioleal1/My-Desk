<div class="row justify-content-center mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('tickets.followup') }}">
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="input-group-append mr-3">
                                    <img class="rounded-circle" src="{{ uploads_path(Auth::user()->avatar) }}" width="55" height="55" />
                                </div>
                                <textarea class="form-control" name="message" placeholder="Descreva aqui sua mensagem..." required></textarea>
                                <div class="input-group-append">
                                    <button name="status" class="btn btn-primary" value="5">
                                        <i class="fas fa-check"></i> Salvar
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr class="hr-dotted">

                        <ul class="timeline">
                            @foreach ($ticket->followups as $followup)
                            <li>
                                <div class="timeline-time">
                                    <span class="date">
                                        <span class="fa fa-calendar-alt"></span>
                                        {{ $followup->created_at->format('d.m.Y H:i:s') }}
                                    </span>
                                </div>
                                <div class="timeline-icon">
                                    <a href="javascript:;">&nbsp;</a>
                                </div>
                                <div class="timeline-body">
                                    <div class="timeline-header">
                                        <span class="userimage">
                                            <img src="{{ uploads_path($followup->user->avatar) }}">
                                        </span>
                                        <span class="username">
                                            <a href="javascript:;">{{ $followup->user->name }}</a>
                                        </span>
                                    </div>
                                    <div class="timeline-content">
                                        <p>{{ $followup->title }}</p>
                                        
                                        @if ($followup->message)
                                        <p class="lead">
                                            <i class="fa fa-quote-left fa-fw pull-left"></i>
                                            {{ $followup->message }}
                                            <i class="fa fa-quote-right fa-fw pull-right"></i>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>