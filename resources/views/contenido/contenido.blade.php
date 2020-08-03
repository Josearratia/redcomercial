@extends('principal')
@section('contenido')

@if (Auth::check())
            @if(Auth::user()->rol == 1)

                    <template v-if="menu==0">
                        <empresas></empresas>
                    </template>

                    <template v-if="menu==1">
                        <usuarios></usuarios>
                    </template>

                    <template v-if="menu==2">
                        <clientes></clientes>
                    </template>

                    <template v-if="menu==3">
                        <vendedores></vendedores>
                    </template>

                    <template v-if="menu==4">
                        <serviciosempresas></serviciosempresas>
                    </template>

                    <template v-if="menu==5">
                        <articulosempresas></articulosempresas>
                    </template>

                    <template v-if="menu==6">
                        <servicios></servicios>
                    </template>

                    <template v-if="menu==7">
                        <articulos></articulos>
                    </template>

                    <template v-if="menu==8">
                        <categorias></categorias>
                    </template>

                    <template v-if="menu==9">
                        <ventas></ventas>
                    </template>

                  

            @elseif(Auth::user()->rol == 2) 

                    <template v-if="menu==10">
                        <perfil :userid={{ Auth::user()->id }}></perfil>
                    </template>

                    <template v-if="menu==15">
                        <cuentav :userid={{ Auth::user()->id }}></cuentav>
                    </template>

                    <template v-if="menu==11">
                        <miempresa :userid={{ Auth::user()->id }}></miempresa>
                    </template>

                    <template v-if="menu==12">
                        <miproductos :userid={{ Auth::user()->id }}></miproductos>
                    </template>

                    <template v-if="menu==13">
                        <miservicios :userid={{ Auth::user()->id }}></miservicios>
                    </template>

                    <template v-if="menu==14">
                        <miventap :userid={{ Auth::user()->id }}></miventap>
                    </template>

                    <template v-if="menu==18">
                        <miventas :userid={{ Auth::user()->id }}></miventas>
                    </template>


            @elseif(Auth::user()->rol == 3) 

               
                    <template v-if="menu==16">
                        <cuentac :userid={{ Auth::user()->id }}></cuentac>
                    </template>

                    <template v-if="menu==17">
                        <perfilv :userid={{ Auth::user()->id }}></perfilv>
                    </template>

                    <template v-if="menu==19">
                        <comprasp :userid={{ Auth::user()->id }}></miventap>
                    </template>

                    <template v-if="menu==20">
                        <comprass :userid={{ Auth::user()->id }}></miventas>
                    </template>

                    <template v-if="menu==21">
                        <carrito :userid={{ Auth::user()->id }}></carrito>
                    </template>

                    <template v-if="menu==22">
                        <mapa :userid={{ Auth::user()->id }}></mapa>
                    </template>
                    
            @else      
            
            @endif

        @endif



@endsection        