package com.example.laundry;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {
    DatabaseHelper myDB2;
    EditText id,nama,paket,layanan,jumlah,tgl_selesai,harga;
    Button btn_tambah;
    Button btn_ubah;
    Button btn_hapus;
    Button btn_semua;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        myDB2 = new DatabaseHelper(this);
        id = (EditText)findViewById(R.id.id);
        nama = (EditText)findViewById(R.id.nama);
        paket = (EditText)findViewById(R.id.paket);
        layanan = (EditText)findViewById(R.id.layanan);
        jumlah = (EditText)findViewById(R.id.jumlah);
        tgl_selesai = (EditText)findViewById(R.id.tgl_selesai);
        harga = (EditText)findViewById(R.id.harga);
        btn_tambah = (Button) findViewById(R.id.btn_tambah);
        btn_ubah = (Button) findViewById(R.id.btn_ubah);
        btn_hapus = (Button) findViewById(R.id.btn_hapus);
        btn_semua = (Button) findViewById(R.id.btn_semua);

        addAction();
        editAction();
        deleteAction();
        showAllAction();
    }

    public void addAction() {
        btn_tambah.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        boolean isInserted = myDB2.insertData(id.getText().toString(),
                                nama.getText().toString(),
                                paket.getText().toString(),
                                layanan.getText().toString(),
                                Integer.parseInt(jumlah.getText().toString()),
                                tgl_selesai.getText().toString(),
                                Integer.parseInt(harga.getText().toString()) );
                        if(isInserted == true)
                            Toast.makeText(MainActivity.this,
                                    "Data Berhasil Ditambahkan",Toast.LENGTH_LONG).show();
                        else
                            Toast.makeText(MainActivity.this,
                                    "Data Gagal Ditambahkan",Toast.LENGTH_LONG).show();
                    }
                }
        );
    }

    public void editAction() {
        btn_ubah.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        boolean isUpdated =  myDB2.updateData(id.getText().toString(),
                                nama.getText().toString(),
                                paket.getText().toString(),
                                layanan.getText().toString(),
                                Integer.parseInt(jumlah.getText().toString()),
                                tgl_selesai.getText().toString(),
                                Integer.parseInt(harga.getText().toString()) );
                        if(isUpdated == true)
                            Toast.makeText(MainActivity.this,
                                    "Data Berhasil Ditambahkan",Toast.LENGTH_LONG).show();
                        else
                            Toast.makeText(MainActivity.this,
                                    "Data Gagal Ditambahkan",Toast.LENGTH_LONG).show();
                    }
                }
        );
    }

    public void deleteAction() {
        btn_hapus.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        String id_ = id.getText().toString();
                        boolean deletedRows = myDB2.deleteData(id_);
                        if(deletedRows)
                            Toast.makeText(MainActivity.this,
                                    "Data Berhasil Dihapus",
                                    Toast.LENGTH_LONG).show();
                        else
                            Toast.makeText(MainActivity.this,
                                    "ID tidak terdaftar",
                                    Toast.LENGTH_LONG).show();
                    }
                }
        );
    }
    public void showMessage(String title,String Message){
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setCancelable(true);
        builder.setTitle(title);
        builder.setMessage(Message);
        builder.show();
    }


    public void showAllAction() {
        btn_semua.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Cursor res = myDB2.getAllData();
                        if(res.getCount() == 0) {
                            // show message
                            showMessage("Error","Nothing found");
                            return;
                        }
                        StringBuffer buffer = new StringBuffer();
                        while (res.moveToNext()) {
                            buffer.append("ID :"+ res.getString(0)+"\n");
                            buffer.append("NAMA :"+ res.getString(1)+"\n");
                            buffer.append("Paket :"+ res.getString(2)+"\n");
                            buffer.append("Layanan :"+ res.getString(3)+"\n\n");
                            buffer.append("Jumlah Cucian :"+ res.getInt(4)+"\n\n");
                            buffer.append("Tanggal Selesai :"+ res.getString(5)+"\n\n");
                            buffer.append("Harga :"+ res.getInt(6)+"\n\n");
                        }
                        showMessage("Data",buffer.toString());
                    }
                }
        );
    }
}
