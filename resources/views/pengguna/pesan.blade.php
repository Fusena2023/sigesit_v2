                      @foreach($pesan as $p)
                        @if($p->dari == 'pengguna')
                          <div class="container2 blue">
                            @if($p->readed == true)
                              <img src="{{url('assets/digilab/images/readed.png')}}" alt="Avatar" style="width:100%;">
                            @else
                              <img src="{{url('assets/digilab/images/yetreaded.png')}}" alt="Avatar" style="width:100%;">
                            @endif
                            <p>{{$p->pesan}}</p>
                            <span class="time-right">{{ date("d, M Y H:i",strtotime($p->created_at)) }}</span>
                          </div>
                        @else
                          <div class="container2 darker">
                            @if($p->readed == true)
                              <img src="{{url('assets/digilab/images/readed.png')}}" alt="Avatar" style="width:100%;">
                            @else
                              <img src="{{url('assets/digilab/images/yetreaded.png')}}" alt="Avatar" style="width:100%;">
                            @endif
                            <p>{{$p->pesan}}</p>
                            <span class="time-left">{{ date("d, M Y H:i",strtotime($p->created_at)) }}</span>
                          </div>
                        @endif
                      @endforeach
                      
