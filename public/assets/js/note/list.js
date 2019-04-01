class NoteList extends List {
	constructor(props) {
		super(props);
		this.state = {
			error: null,
			isLoaded: false,
			items: [],
		};

		this.fetchUrl = "/notes-list"
	}

	render() {
		const { error, isLoaded, items } = this.state;
		if (error) {
			return <div>Error: {error.message}</div>;
		} else if (!isLoaded) {
			return <div>Loading...</div>;
		} else {
			return (
				<div className="col-12">
					{items.map((item, index) => 
						<div className="row mb-2" key={item.id}>
							<div className="col-12 col-md-7">
								<input className="w-100 form-control" type="text" defaultValue={ item.text } />
							</div>
							<div className="col-5 col-md-2">
								{ item.created_at }
							</div>
							<div className="col-7 col-md-3 btn-group-col">
								<button className="btn btn-danger" onClick={() => this.rowAction(item.remove_url)}>Remove</button>
								<button className="btn btn-danger" onClick={() => this.rowAction(item.done_url)}>Done</button>
							</div>
						</div>
					)}
				</div>
			)
		}
	}
}