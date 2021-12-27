<?php


namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Cartera extends Component
{
    public function render()
    {
        return view('livewire.cartera')->layout('components.plantilla');
        
    }

    public function saveExcel(Request $request)
    {

        $request->validate([
            'excel' => 'required|max:10000|mimes:xlsx,xls'
        ]);

        $file_array = explode(".", $_FILES["excel"]["name"]);
        $file_extension = end($file_array);

        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($_FILES["excel"]["tmp_name"], $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($file_name);

        unlink($file_name);

        $data = $spreadsheet->getActiveSheet()->toArray();

        dd($data);

        // foreach ($data as $key => $row) {
        //     if ($key >= 1) {

        //         $marca_id = DB::table('marcas')->where('nombre', 'like', '%' . $row[3] . '%')->value('id');

        //         if (empty($marca_id)) {
        //             $marca_id = DB::table('marcas')->insertGetId(
        //                 array('nombre' => $row[3], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
        //             );
        //         }

        //         $proveedor_id = DB::table('proveedores')->where('nombre', 'like', '%' . $row[7] . '%')->value('id');

        //         if (empty($proveedor_id)) {
        //             $proveedor_id = DB::table('proveedores')->insertGetId(
        //                 array('nombre' => $row[7], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
        //             );
        //         }

        //         $insert_data = array(
        //             'sku'  => $row[0],
        //             'nombre_producto'  => $row[1],
        //             'descripcion'  => $row[2],
        //             'marca_id'  => $marca_id,
        //             'grupo' => $row[4],
        //             'seccion'  => $row[5],
        //             'clasificacion'  => $row[6],
        //             'proveedor_id'  => $proveedor_id,
        //             'estilo'  => $row[8],
        //             'color'  => $row[9],
        //             'talla'  => $row[10],
        //             'cantidad_inicial'  => $row[11],
        //             'stock'  => $row[11],
        //             'valor_venta'  => $row[12],
        //             'nombre_mostrar'  => $row[13],
        //             'categoria'  => $row[14],
        //             'subcategoria'  => $row[15],
        //             'precio_empresaria'  => $row[16],
        //             'descuento'  => $row[17]
        //         );

        //         //Producto::create($insert_data);
        //     }
        // }

        return redirect()->route('giras')
            ->with('success', 'Productos cargados correctamente');
    }
}
