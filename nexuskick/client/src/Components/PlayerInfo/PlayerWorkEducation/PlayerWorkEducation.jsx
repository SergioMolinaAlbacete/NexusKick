import React from 'react';
import './PlayerWorkEducation.css';

const PlayerWorkEducation = ({ workEducation }) => {
  return (
    <div className="work-info">
      <h2>Situación Laboral y/o Estudio</h2>
      <table>
        <tbody>
          <tr>
            <td>Actividad</td>
            <td>Ciclo superior DAW</td>
          </tr>
          <tr>
            <td>Lugar</td>
            <td>EIG Business School</td>
          </tr>
          <tr>
            <td>Horario</td>
            <td>08:15 - 14:45</td>
          </tr>
        </tbody>
      </table>
    </div>
  );
};

export default PlayerWorkEducation;
