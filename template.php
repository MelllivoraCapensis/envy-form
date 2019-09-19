<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fill and Submit</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="static/main.css">
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
</head>
<body>
	<div class="container">
		<h2 class="mb-3">
			Fill and Submit
		</h2>
		<form @submit="submit" method="POST">
			<div v-if="alert" :class="{'alert-success': success, 'alert-danger': fail}" class="alert text-center" v-cloak>{{ alert }}</div>
			<div class="form-group">
				<label for="nameInput">Name</label>
				<input @keyup="resetInfo" class="form-control" name="name" placeholder="allowed: chars, numbers, -, _" id="nameInput">
				<p v-if="errors.nameError" class="alert-danger d-inline-block p-1 mt-2 pl-3 pr-3 rounded" v-cloak>{{ errors.nameError }}</p>
			</div>
			<div class="form-group">
				<label for="phoneInput">Phone</label>
				<input @keyup="resetInfo" class="form-control" type="tel" name="phone" placeholder="+7-xxx-xxx-xx-xx" id="phoneInput">
				<p v-if="errors.phoneError" class="alert-danger d-inline-block p-1 mt-2 pl-3 pr-3 rounded" v-cloak>{{ errors.phoneError }}</p>
			</div>
			<div class="form-group">
				<label for="messageInput">Message</label>
				<textarea @keyup="resetInfo" class="form-control" name="message" id="messageInput" placeholder="from 20 to 200 chars ..."></textarea>
				<p v-if="errors.messageError" class="alert-danger d-inline-block p-1 mt-2 pl-3 pr-3 rounded" v-cloak>{{ errors.messageError }}</p>
			</div>
			<div class="form-group">
				<label for="storageSelect">Save to</label>
				<select @keyup="resetInfo" class="form-control" name="storage" id="storageSelect">
					<?php foreach(SaverFactory::STORAGE_TYPES as $type): ?>
						<option value="<?= $type ?>"><?= $type ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<button class="btn btn-primary w-100">Submit</button>
		</form>
	</div>
	
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="static/main.js"></script>
</body>
</html>
