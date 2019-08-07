<div class="row justify-content-center mt-2">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Solicitante</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $ticket->user->name }}</p>
                    </div>
                </div>

                <hr class="hr-dotted">
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Data de Abertura</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $ticket->created_at->format('d.m.Y') }}</p>
                    </div>
                </div>

                <hr class="hr-dotted">
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tipo de Solicitação</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ get_type_ticket($ticket->type) }}</p>
                    </div>
                </div>

                <hr class="hr-dotted">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Categoria</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $ticket->category->name }}</p>
                    </div>
                </div>

                <hr class="hr-dotted">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sistema</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $ticket->system->name }}</p>
                    </div>
                </div>

                <hr class="hr-dotted">
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Prioridade</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ get_priority_ticket($ticket->priority) }}</p>
                    </div>
                </div>

                <hr class="hr-dotted">
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Assunto</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $ticket->subject }}</p>
                    </div>
                </div>

                <hr class="hr-dotted">
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{!! $ticket->description !!}</p>
                    </div>
                </div>

                <hr class="hr-dotted">
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">
                            <span class="btn btn-sm btn-{{ get_color_ticket($ticket->status) }} ">
                                {{ get_status_ticket($ticket->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <hr class="hr-dotted">
                        
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Técnico</label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">
                            {{ $ticket->technician->name ?? 'Não Atribuído' }}
                        </p>
                    </div>
                </div>

                @if ($ticket->status == 4 && Gate::check('tickets.feedback'))
                    <hr class="hr-dotted">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Solução</label>
                        <div class="col-md-9">
                            <p class="form-control-plaintext">{!! $ticket->solution !!}</p>
                        </div>
                    </div>

                    <hr class="hr-dotted">
                        
                    <form method="POST" action="{{ route('tickets.feedback', $ticket->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                Comentar Solução
                            </label>
                            <div class="col-md-9">
                                <textarea name="message" class="form-control" rows="4"
                                    placeholder="Comente aqui se a solução mencionada acima atendeu à sua solicitação..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                Nível de Satisfação
                            </label>
                            <div class="col-md-9 rating">
                                <div class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" required />
                                    <label class="full" for="star5" title="05 estrelas"></label>
                                    
                                    <input type="radio" id="star4" name="rating" value="4" required />
                                    <label class="full" for="star4" title="04 estrelas"></label>
                                    
                                    <input type="radio" id="star3" name="rating" value="3" required />
                                    <label class="full" for="star3" title="03 estrelas"></label>
                                    
                                    <input type="radio" id="star2" name="rating" value="2" required />
                                    <label class="full" for="star2" title="02 estrelas"></label>
                                    
                                    <input type="radio" id="star1" name="rating" value="1" required />
                                    <label class="full" for="star1" title="01 estrela"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <button name="status" class="btn btn-primary" value="5">
                                    <i class="fas fa-thumbs-up"></i> Aprovar Solução
                                </button>

                                <button name="status" class="btn btn-danger" value="2">
                                    <i class="fas fa-thumbs-down"></i> Reprovar Solução
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

            </div>

            <div class="card-footer">
                <p>
                    <i class="fa fa-calendar-check"></i> Cadastrado em: {{ $ticket->created_at->format('d.m.Y H:i:s') }}
                </p>
                <p>
                    <i class="fa fa-calendar-alt"></i> Atualizado em: {{ $ticket->updated_at->format('d.m.Y H:i:s') }}
                </p>
            </div>
        </div>
    </div>
</div>