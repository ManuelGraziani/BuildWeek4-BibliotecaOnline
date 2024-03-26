import React from "react";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function BookComponent({ books, users }) {
    console.log(books);
    console.log(users);
    return (
        <AuthenticatedLayout>
            <div className="container">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    {books.map((book) => (
                        <div class="col">
                            <Card key={book.id} style={{ width: "18rem" }}>
                                <Card.Img
                                    variant="top"
                                    src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg"
                                />
                                <Card.Body>
                                    <div class="row">
                                        <Card.Title>{book.title}</Card.Title>
                                        <Card.Text>
                                            {book.description}
                                        </Card.Text>
                                        <Card.Text>
                                            {book.authors.map((author) => (
                                                <li key={author.id}>
                                                    {author.name}
                                                </li>
                                            ))}
                                        </Card.Text>
                                        <Card.Text>{book.pages}</Card.Text>
                                        <Card.Text>{book.numcopies}</Card.Text>
                                        <Card.Text>
                                            {book.reservations.map(
                                                (reservation) => (
                                                    <li key={reservation.id}>
                                                        {reservation.stato}
                                                    </li>
                                                )
                                            )}
                                        </Card.Text>
                                        <Card.Text>
                                            {book.categories.map((category) => (
                                                <li key={category.id}>
                                                    {category.name}
                                                </li>
                                            ))}
                                        </Card.Text>
                                        <Button variant="primary">
                                            Go somewhere
                                        </Button>
                                    </div>
                                </Card.Body>
                            </Card>
                        </div>
                    ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
