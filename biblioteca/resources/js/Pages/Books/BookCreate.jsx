import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useState } from "react";
import { router } from "@inertiajs/react";

export default function BookCreate() {
    const [values, setValues] = useState({
        title: "",
        description: "",
        name: "",
        city: "",
        pages: "",
        numcopies: "",
        year: "",
    });

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value;
        setValues((values) => ({
            ...values,
            [key]: value,
        }));
    }

    function handleSubmit(e) {
        e.preventDefault();
        router.post("/books", values);
    }
    return (
        <AuthenticatedLayout>
            <div className="container">
                <form onSubmit={handleSubmit}>
                    <div class="mb-3">
                        <label htmlFor="title" class="form-label">
                            Titolo
                        </label>
                        <input
                            id="title"
                            value={values.title}
                            onChange={handleChange}
                        />
                    </div>
                    <div class="mb-3">
                        <label htmlFor="description" class="form-label">
                            Descrizione
                        </label>
                        <input
                            id="description"
                            value={values.description}
                            onChange={handleChange}
                        />
                    </div>
                    <div class="mb-3">
                        <label htmlFor="name" class="form-label">
                            Autore
                        </label>
                        <input
                            id="name"
                            value={values.author}
                            onChange={handleChange}
                        />
                    </div>
                    <div class="mb-3">
                        <label htmlFor="city" class="form-label">
                            Autore citta
                        </label>
                        <input
                            id="city"
                            value={values.city}
                            onChange={handleChange}
                        />
                    </div>
                    <div class="mb-3">
                        <label htmlFor="category" class="form-label">
                            Categoria
                        </label>
                        <select
                            id="category"
                            value={values.category}
                            onChange={handleChange}
                        >
                            <option selected>Scegli categoria</option>
                            <option value="Horror">Horror</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Fiction">Fiction</option>
                            <option value="Romance">Romance</option>
                            <option value="Mystery">Mystery</option>
                            <option value="History">History</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label htmlFor="year" class="form-label">
                            Anno
                        </label>
                        <input
                            id="year"
                            value={values.year}
                            onChange={handleChange}
                        />
                    </div>
                    <div class="mb-3">
                        <label htmlFor="pages" class="form-label">
                            Pagine
                        </label>
                        <input
                            type="number"
                            id="pages"
                            value={values.pages}
                            onChange={handleChange}
                        />
                    </div>
                    <div class="mb-3">
                        <label htmlFor="numcopies" class="form-label">
                            Numero copie
                        </label>
                        <input
                            min='1'
                            max='5'
                            type="number"
                            id="numcopies"
                            value={values.numcopies}
                            onChange={handleChange}
                        />
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">
                        Aggiungi
                    </button>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
