import swal from "sweetalert2";

class Flash {
	info(text, title = "Great") {
		swal({
			type: "info",
			text: text,
			title
		});
	}

	success(text, title = "Great") {
		swal({
			type: "success",
			text: text,
			title
		});
	}
	error(text) {
		swal({
			type: "error",
			text
		});
	}
	html(html,title="Great",type='info'){
		swal({
			type,
			title,
			html
		})
	}

}

export { Flash };
