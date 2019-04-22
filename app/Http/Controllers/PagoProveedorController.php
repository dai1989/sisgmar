<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoProveedorRequest;
use App\Http\Requests\UpdatePagoProveedorRequest;
use App\Repositories\PagoProveedorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PagoProveedorController extends AppBaseController
{
    /** @var  PagoProveedorRepository */
    private $pagoProveedorRepository;

    public function __construct(PagoProveedorRepository $pagoProveedorRepo)
    {
        $this->pagoProveedorRepository = $pagoProveedorRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the PagoProveedor.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoProveedorRepository->pushCriteria(new RequestCriteria($request));
        $pagoProveedors = $this->pagoProveedorRepository->all();

        return view('pago_proveedors.index')
            ->with('pagoProveedors', $pagoProveedors);
    }

    /**
     * Show the form for creating a new PagoProveedor.
     *
     * @return Response
     */
    public function create()
    {
        return view('pago_proveedors.create');
    }

    /**
     * Store a newly created PagoProveedor in storage.
     *
     * @param CreatePagoProveedorRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoProveedorRequest $request)
    {
        $input = $request->all();

        $pagoProveedor = $this->pagoProveedorRepository->create($input);

        Flash::success('Pago Proveedor guardado exitosamente.');

        return redirect(route('pagoProveedors.index'));
    }

    /**
     * Display the specified PagoProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pagoProveedor = $this->pagoProveedorRepository->findWithoutFail($id);

        if (empty($pagoProveedor)) {
            Flash::error('Pago Proveedor no encontrado');

            return redirect(route('pagoProveedors.index'));
        }

        return view('pago_proveedors.show')->with('pagoProveedor', $pagoProveedor);
    }

    /**
     * Show the form for editing the specified PagoProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pagoProveedor = $this->pagoProveedorRepository->findWithoutFail($id);

        if (empty($pagoProveedor)) {
            Flash::error('Pago Proveedor no encontrado');

            return redirect(route('pagoProveedors.index'));
        }

        return view('pago_proveedors.edit')->with('pagoProveedor', $pagoProveedor);
    }

    /**
     * Update the specified PagoProveedor in storage.
     *
     * @param  int              $id
     * @param UpdatePagoProveedorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoProveedorRequest $request)
    {
        $pagoProveedor = $this->pagoProveedorRepository->findWithoutFail($id);

        if (empty($pagoProveedor)) {
            Flash::error('Pago Proveedor no encontrado');

            return redirect(route('pagoProveedors.index'));
        }

        $pagoProveedor = $this->pagoProveedorRepository->update($request->all(), $id);

        Flash::success('Pago Proveedor actualizado exitosamente.');

        return redirect(route('pagoProveedors.index'));
    }

    /**
     * Remove the specified PagoProveedor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pagoProveedor = $this->pagoProveedorRepository->findWithoutFail($id);

        if (empty($pagoProveedor)) {
            Flash::error('Pago Proveedor no encontrado');

            return redirect(route('pagoProveedors.index'));
        }

        $this->pagoProveedorRepository->delete($id);

        Flash::success('Pago Proveedor eliminado exitosamente.');

        return redirect(route('pagoProveedors.index'));
    }
}
