/** @type {import('tailwindcss').Config} */
module.exports = {
	// content: ["./**/*.php"],
	content: [
		"./**/*.php",
		"./inc/**/*.php",
		"./templates/**/*.php",
		"./inc/*.php",
	],
	theme: {
		extend: {
			fontFamily: {
				kalpurush: ["Kalpurush", "sans-serif"],
			},
			boxShadow: {
				xs: "0 0 5px 0 rgba(0,0,0, 0.1)",
				sm: "0 0 5px 0 rgba(0,0,0, 0.12)",
			},
			colors: {
				primary: "#b51a1a",
			},
			container: {
				center: true,
				screens: {
					"2xl": "1240px",
				},
			},
		},
	},
	plugins: [],
};
