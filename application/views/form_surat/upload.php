<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test upload</title>
</head>
<body>
    <?php echo $error;?>

    <?php echo form_open_multipart('upload/upload_doc')?>

    <input type="file" name="berkas" />
    <input type="submit" value="upload" />
    </form>
</body>
</html>