{ pkgs }: {
	deps = [
	pkgs.nodejs-16_x
	pkgs.code-server
	pkgs.sqlite.bin
	pkgs.php82Packages.composer
	pkgs.php82
	];
}