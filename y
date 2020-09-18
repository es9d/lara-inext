{
	"authHost": "",
	"authEndpoint": "/broadcasting/auth",
	"clients": [
		{
			"appId": "c51d1866a0136084",
			"key": "410f70fa6eeb9955740908de86445819"
		}
	],
	"database": "sqlite",
	"databaseConfig": {
		"redis": {},
		"sqlite": {
			"databasePath": "/database/laravel-echo-server.sqlite"
		}
	},
	"devMode": true,
	"host": null,
	"port": "6001",
	"protocol": "http",
	"socketio": {},
	"secureOptions": 67108864,
	"sslCertPath": "",
	"sslKeyPath": "",
	"sslCertChainPath": "",
	"sslPassphrase": "",
	"subscribers": {
		"http": true,
		"redis": true
	},
	"apiOriginAllow": {
		"allowCors": true,
		"allowOrigin": "y",
		"allowMethods": "y",
		"allowHeaders": "y"
	}
}