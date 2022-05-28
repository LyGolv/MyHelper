const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const eye_signin = document.querySelector("#eye_signin");
const eye_signup = document.querySelector("#eye_signup");
const inputs = document.querySelectorAll('input[type=file]');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

eye_signin.addEventListener('click', () => {
	pwd_signin = document.querySelector('input[name="password_signin"]');
	if (eye_signin.innerHTML == "visibility") {
		eye_signin.innerHTML = "visibility_off";
		pwd_signin.setAttribute('type', 'password');
	}
	else {
		eye_signin.innerHTML = "visibility";
		pwd_signin.setAttribute('type', 'text');
	}
})

eye_signup.addEventListener('click', () => {
	pwd_signup = document.querySelector('input[name="password_signup"]');
	if (eye_signup.innerHTML == "visibility") {
		eye_signup.innerHTML = "visibility_off";
		pwd_signup.setAttribute('type', 'password');
	}
	else {
		eye_signup.innerHTML = "visibility";
		pwd_signup.setAttribute('type', 'text');
	}
})
