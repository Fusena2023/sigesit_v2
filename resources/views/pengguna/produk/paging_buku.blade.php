<div class="row" id="contentBukuField">
<div class="row">
    @if(count((array)$resProduk['original']['data']['data']) > 0)
    @for($i=0;$i<count($resProduk['original']['data']['data']);$i++)
    <div class="col-xs-6 col-md-3" style="cursor:pointer;padding:10px;background-color:#777aba;border:1px solid white">
        <a onclick="tambahItemKeKeranjang({{ $resProduk['original']['data']['data'][$i]['id_sub'] }},{{ $resProduk['original']['data']['data'][$i]['tarif'] }},'{{ $resProduk['original']['data']['data'][$i]['nama_lembar'] }}')">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <div>
                    <font color="#FFD700">
                        <b>Rp <?php echo number_format($resProduk['original']['data']['data'][$i]['tarif'],0,".","."); ?><br>
                    </font>
                    <span style="display:none;"><?php echo 'Stok Tersedia : '.number_format($resProduk['original']['data']['data'][$i]['stok_baik'],0,".","."); ?></span>
                    <p class="name" style="color:black;"><?php echo $resProduk['original']['data']['data'][$i]['nama_subproduk']." / ".$resProduk['original']['data']['data'][$i]['nama_lembar']; ?></b></p>
                </div>
            </div>
        </div>
        </a>
    </div>
    @endfor
    @else 
    <p><b>Tidak ada data</b></p>
    @endif
</div>
<div class="row">
    <table>
        <tr>
            <td>
            <nav aria-label="pagingkatalog" id="pagingkatalog">
                <ul class="pagination pagination-sm" >
            <?php
                $link = "";
                $page = (count((array)$resProduk['original']['data']['data']) > 0)?$resProduk['original']['data']['current_page']:1; // your current page
                $pages=(count((array)$resProduk['original']['data']['data']) > 0)?$resProduk['original']['data']['total']:1; // Total number of pages
                
                $limit=8  ; // May be what you are looking for

                if ($pages >=1 && $page <= $pages)
                {
                    $counter = 1;
                    $link = "";
                    if ($page > ($limit/2))
                    { $link .= "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li> ... ";}
                    if($pages > $limit){
                        for ($x=$page; $x<=$pages;$x++)
                        {

                            if($counter < $limit)
                                $link .= "<li class='page-item'><a class='page-links' href='?page=".$x."'>".$x."</a></li>";

                            $counter++;
                        }

                        if ($page < $pages - ($limit/2))
                        { $link .= "... " . "<li class='page-item'><a class='page-link' href='?page=" .$pages."'>".$pages."</a></li>"; }
                    }
                    
                }

                echo $link;
            ?>
                </ul>
            </nav>
            
            </td>
        </tr>
    </table>
</div>
</div>
