package com.example.aplapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import org.w3c.dom.Text;

import java.net.HttpURLConnection;
import java.net.URL;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        EditText username;
        EditText password;
        Button loginButton;

        username = (EditText) findViewById(R.id.username);
        password = (EditText)findViewById(R.id.password);
        loginButton = (Button) findViewById(R.id.button);

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String tx_username = username.getText().toString();
                String tx_password = password.getText().toString();

                if (TextUtils.isEmpty(tx_username) || TextUtils.isEmpty((tx_password))) {
                    Toast.makeText(MainActivity.this, "Enter username and password", Toast.LENGTH_SHORT).show();

                } else {
                    //CREATE LOGIN

                    new AsyncLogin().execute(tx_username, tx_password);
                }
            }

            class AsyncLogin extends AsyncTask<String, String, String> {

                ProgressDialog pdLoading = new ProgressDialog(MainActivity.this);
                HttpURLConnection conn;
                URL url = null;

                @Override
                protected void onPreExecute() {
                    super.onPreExecute();

                    pdLoading.setMessage("\tLoading...");
                    pdLoading.setCancelable(false);
                    pdLoading.show();
                }

                @Override
                protected String doInBackground(String... strings) {
                    try {
                        url = new URL(http://localhost:8080/APL/appLogin.php?);
                    }
                }
            }
        });

    }
}